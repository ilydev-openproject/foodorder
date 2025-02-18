<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Meja;
use Filament\Tables;
use Filament\Forms\Form;
use Endroid\QrCode\QrCode;
use Filament\Tables\Table;
use Endroid\QrCode\Logo\Logo;
use Filament\Resources\Resource;
use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use App\Models\Table as ModelsTable;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Endroid\QrCode\ErrorCorrectionLevel;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MejaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MejaResource\RelationManagers;

class MejaResource extends Resource
{
    protected static ?string $model = ModelsTable::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Meja';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Meja')
                    ->unique(ignoreRecord: true)
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Tersedia',
                        'occupied' => 'Terisi',
                    ])
                    ->default('available')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('qr_code')
                    ->label('QR Code')
                    ->getStateUsing(fn($record) => self::generateQrCode($record))
                    ->size(100),
                TextColumn::make('name')
                    ->label('Nama Meja')
                    ->sortable()
                    ->width('10%'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => $state === 'available' ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => ucfirst($state))
                    ->width('10%'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('download_qr')
                    ->label('Download QR')
                    ->icon('heroicon-o-archive-box-arrow-down')
                    ->action(function ($record) {
                        return response()->streamDownload(function () use ($record) {
                            // Create the QR code
                            $qrCode = new QrCode(
                                data: url("/meja/{$record->id}"),
                                encoding: new Encoding('UTF-8'),
                                errorCorrectionLevel: ErrorCorrectionLevel::High,
                                size: 500,
                                margin: 10
                            );

                            // Create the logo
                            $logo = new Logo(
                                path: public_path('logo/logo.png'),
                                resizeToWidth: 150,
                                punchoutBackground: false
                            );

                            // Create the writer to generate PNG
                            $writer = new PngWriter();
                            $result = $writer->write($qrCode, $logo);

                            // Output the QR code with logo as PNG
                            echo $result->getString();
                        }, "qr-{$record->id}.png");
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function generateQrCode($table)
    {
        $url = url("/meja/{$table->id}");

        // Buat QR Code baru
        $qrCode = QrCode::create($url)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::High)
            ->setSize(300)
            ->setMargin(10);

        // Tambahkan Logo
        $logoPath = public_path('logo/logo.png');
        $logo = Logo::create($logoPath)->setResizeToWidth(150);

        // Generate QR Code dengan logo
        $writer = new PngWriter();
        $result = $writer->write($qrCode, $logo);

        // Return sebagai data URI untuk ditampilkan di frontend
        return $result->getDataUri();
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
            'index' => Pages\ListMejas::route('/'),
            'create' => Pages\CreateMeja::route('/create'),
            'edit' => Pages\EditMeja::route('/{record}/edit'),
        ];
    }
}
