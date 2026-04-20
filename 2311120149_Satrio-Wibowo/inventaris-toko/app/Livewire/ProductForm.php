<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('layouts.app')]
class ProductForm extends Component
{
    public ?Product $product = null;

    #[Rule('required|string|min:3|max:255')]
    public string $name = '';

    #[Rule('required|string|max:100')]
    public string $category = '';

    #[Rule('required|numeric|min:0')]
    public string $price = '';

    #[Rule('required|integer|min:0')]
    public string $stock = '';

    #[Rule('nullable|string|max:1000')]
    public string $description = '';

    public function mount(?Product $product = null): void
    {
        if ($product && $product->exists) {
            $this->product     = $product;
            $this->name        = $product->name;
            $this->category    = $product->category;
            $this->price       = (string) $product->price;
            $this->stock       = (string) $product->stock;
            $this->description = $product->description ?? '';
        }
    }

    public function save(): void
    {
        $uniqueRule = 'unique:products,name' . ($this->product?->id ? ",{$this->product->id}" : '');

        $this->validateOnly('name', ['name' => ['required', 'string', 'min:3', 'max:255', $uniqueRule]]);
        $this->validate();

        $data = [
            'name'        => $this->name,
            'category'    => $this->category,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'description' => $this->description ?: null,
        ];

        if ($this->product?->exists) {
            $this->product->update($data);
            $message = 'Produk berhasil diperbarui.';
        } else {
            Product::create($data);
            $message = 'Produk berhasil ditambahkan.';
        }

        session()->flash('success', $message);
        $this->redirect(route('products.index'), navigate: true);
    }

    // Title dinamis: berbeda antara create dan edit
    #[Title('Tambah Produk')]
    public function render()
    {
        $isEditing = $this->product?->exists;

        // Override title saat mode edit
        if ($isEditing) {
            $this->dispatch('title', 'Edit Produk');
        }

        return view('livewire.product-form', compact('isEditing'));
    }
}