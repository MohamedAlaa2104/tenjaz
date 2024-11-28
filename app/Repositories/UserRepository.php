<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function __construct(protected User $user)
    {
    }

    public function getAll(): Collection
    {
        return $this->user->all();
    }

    public function getById(int $id): User|null
    {
        return $this->user->find($id);
    }

    public function create(array $attributes): User
    {
        return $this->user->create($attributes);
    }

    public function update(array $attributes, int $id): bool
    {
        return $this->user->findOrFail($id)->update($attributes);
    }

    public function delete(int $id): bool
    {
        return $this->user->findOrFail($id)->delete();
    }

}
