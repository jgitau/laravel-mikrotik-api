<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class FormLogin extends Component
{

  public $ip,$user,$pass;

  protected $rules = [
    'ip' => 'required',
    'user' => 'required',
    'pass' => 'required',
  ];

  protected $messages = [
    'ip.required' => 'IP Address harus diisi!',
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
      'ip' => $this->ip,
      'user' => $this->user,
      'pass' => $this->pass,
    ];
    session()->put('data', $data);
    dd(session('data'));
  }
}
