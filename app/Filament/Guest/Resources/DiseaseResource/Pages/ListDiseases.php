<?php

namespace App\Filament\Guest\Resources\DiseaseResource\Pages;

use App\Filament\Guest\Resources\DiseaseResource;
use Filament\Resources\Pages\ListRecords;

class ListDiseases extends ListRecords
{
    protected static string $resource = DiseaseResource::class;
}
