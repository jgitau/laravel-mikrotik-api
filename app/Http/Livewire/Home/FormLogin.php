<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class FormLogin extends Component
{

  public $user,$pass;

  protected $rules = [
    'user' => 'required',
    'pass' => 'required',
  ];

  protected $messages = [
    'user.required' => 'Username harus diisi!',
    'pass.required' => 'Password harus diisi!',
  ];

  /**
   * updated
   *
   * @param  mixed $property
   * @return void
   */
  public function updated($property)
  {
    // Every time a property changes
    // (only `text` for now), validate it
    $this->validateOnly($property);
  }

  /**
   * render
   */
  public function render()
  {
    return view('livewire.home.form-login');
  }

  // TODO:
  /**
   * submit
   *
   * @return void
   */
  public function submit()
  {
    $this->validate();
    $data = [
      'user' => $this->user,
      'pass' => $this->pass,
    ];
    session()->put('data', $data);
    dd(session('data'));
  }
}
