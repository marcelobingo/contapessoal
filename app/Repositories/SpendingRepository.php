<?php

namespace App\Repositories;

use App\Models\Spending;
use Exception;

class SpendingRepository
{
    public function getValidationRules(): array
    {
        return [
            'tag_id' => 'nullable|exists:tags,id', // TODO CHECK IF TAG BELONGS TO USER
            'date' => 'required|date|date_format:d/m/Y',
            'description' => 'required|max:255',
            'currency_id' => 'nullable|exists:currencies,id',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }

    public function create(
        int $spaceId,
        ?int $recurringId,
        ?int $tagId,
        string $date,
        string $description,
        int $amount,
        ?int $importId = null
    ): Spending {
        return Spending::create([
            'space_id' => $spaceId,
            'import_id' => $importId,
            'recurring_id' => $recurringId,
            'tag_id' => $tagId,
            'happened_on' => $date,
            'description' => $description,
            'amount' => $amount
        ]);
    }

    public function update(int $spendingId, array $data): void
    {
        $spending = Spending::find($spendingId);

        if (!$spending) {
            throw new Exception('Could not find spending with ID ' . $spendingId);
        }

        $spending->fill($data)->save();
    }
}
