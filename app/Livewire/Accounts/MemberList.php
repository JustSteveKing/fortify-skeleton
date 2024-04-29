<?php

declare(strict_types=1);

namespace App\Livewire\Accounts;

use App\Models\Member;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class MemberList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public string $account;

    public function table(Table $table): Table
    {
        return $table->query(Member::query()->with([
            'user',
        ])->where(
            column: 'account_id',
            operator: '=',
            value: $this->account,
        ))->columns([
            ImageColumn::make('user.avatar')->label('Avatar'),
            TextColumn::make('user.name')->label('User')->sortable()->searchable(),
            TextColumn::make('role')->label('Role')->sortable()->badge(),
            TextColumn::make('created_at')->date('l jS \\of F Y h:i:s A')->label('Created At')->sortable()->searchable(),
        ]);
    }

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.accounts.member-list',
        );
    }
}
