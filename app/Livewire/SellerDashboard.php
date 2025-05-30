<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class SellerDashboard extends Component
{
    use WithFileUploads;

    // Profile fields
    public $name;
    public $email;
    public $phone;
    public $role;
    public $current_password;
    public $password;
    public $password_confirmation;

    // Property fields
    public $property_name;
    public $property_price;
    public $offer_type = 'sale';
    public $property_address;
    public $phone_number;
    public $property_type = 'apartment';
    public $finish_status = 'finished';
    public $property_description;
    public $image_1;
    public $image_2;

    public $properties = [];

    public function mount()
    {
        $user = User::findOrFail(Auth::id());
        if (!$user || $user->role !== 'seller') {
            $this->redirect('/login');
            return;
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->role = $user->role;

        $this->loadProperties();
    }

    public function loadProperties()
    {
        $user = User::findOrFail(Auth::id());
        $this->properties = $user->properties->groupBy('property_type')->map(function ($group) {
            return $group->map(function ($property) {
                return $property->toArray();
            });
        })->toArray();
    }

    public function updateProfile()
    {
        $user = User::findOrFail(Auth::id());

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'current_password' => 'nullable|required_with:password,password_confirmation',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];

        $user->update($data);

        if ($this->current_password) {
            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'The current password is incorrect.');
                return;
            }
            $user->update(['password' => Hash::make($this->password)]);
            session()->flash('success', 'Profile and password updated successfully!');
        } else {
            session()->flash('success', 'Profile updated successfully!');
        }

        $this->reset(['current_password', 'password', 'password_confirmation']);
    }

    public function storeProperty()
    {
        $this->validate([
            'property_name' => 'required|string|max:255',
            'property_price' => 'required|numeric|min:0',
            'offer_type' => 'required|in:sale,rent',
            'property_address' => 'required|string|min:10',
            'phone_number' => 'required|regex:/^[0-9]{10}$/',
            'property_type' => 'required|in:apartment,house,land',
            'finish_status' => 'required|in:finished,unfinished',
            'property_description' => 'required|string|min:10',
            'image_1' => 'nullable|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
        ]);

        $data = [
            'property_name' => $this->property_name,
            'property_price' => $this->property_price,
            'offer_type' => $this->offer_type,
            'property_address' => $this->property_address,
            'phone_number' => $this->phone_number,
            'property_type' => $this->property_type,
            'finish_status' => $this->finish_status,
            'property_description' => $this->property_description,
            'user_id' => Auth::id(),
        ];

        if ($this->image_1) {
            $data['image_1'] = $this->image_1->store('properties', 'public');
        }
        if ($this->image_2) {
            $data['image_2'] = $this->image_2->store('properties', 'public');
        }

        Property::create($data);

        session()->flash('success', 'Property added successfully!');
        $this->reset([
            'property_name', 'property_price', 'offer_type', 'property_address',
            'phone_number', 'property_type', 'finish_status', 'property_description',
            'image_1', 'image_2',
        ]);
        $this->loadProperties();
    }

    public function render()
    {
        return view('livewire.seller-dashboard');
    }
}