<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Manajemen Transaksi';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Toko')
                    ->relationship('user', 'name')
                    ->required()
                    ->reactive()
                    ->hidden(fn()=>auth()->user()->role === 'store'),
                Forms\Components\TextInput::make('code')
                    ->label('Kode transaksi')
                    ->default(fn()=> 'TRX-'. mt_rand(1000,9999))
                    ->readOnly()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Customer')
                    ->required(),
                Forms\Components\TextInput::make('table_number')
                    ->label('Nomer Meja')
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options(['cash'=>'Tunai','midtrans'=>'Midtrans'])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status Pembayaran')
                    ->options(['pending'=>'Tertunda','success'=>'Berhasil','failed'=>'Gagal'])
                    ->required(),
                Forms\Components\Repeater::make('transactionDetails')
                    ->relationship() // biarkan kosong jika relasi sudah di model
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product','name')
                            ->options(function (callable $get) {
                                // Jika ingin ambil semua produk:
                                if (Auth::user()->role === 'admin') {
                                    return Product::all()->mapWithKeys(function ($product) {
                                        return [
                                            $product->id => $product->name . ' (Rp ' . number_format($product->price) . ')'
                                        ];
                                    });
                                }
                                return Product::all()->mapWithKeys(function ($product) {
                                    return [
                                        $product->id => $product->name . ' (Rp ' . number_format($product->price) . ')'
                                    ];
                                });
  
                            })
                            ->required(),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Kuantitas')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1),
                        Forms\Components\TextInput::make('note')
                            ->label('Note'),
                    ])->columnSpanFull()
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::updateTotalPrice($get, $set);
                    })
                    ->reorderable(false),
                Forms\Components\TextInput::make('total_price')
                    ->label('Total Harga (Rp)')
                    ->readOnly()
                    ->required(),
                    
            ]);
                
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
