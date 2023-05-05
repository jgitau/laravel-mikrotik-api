<?php

// app/Traits/LivewireMessageEvents.php

namespace App\Traits;

trait LivewireMessageEvents
{
    /**
     * Dispatch a success event with the given message
     *
     * @param string $message Success message to be displayed
     */
    public function dispatchSuccessEvent($message)
    {
        // Dispatch the browser event with the success message
        $this->dispatchBrowserEvent('message', ['success' => $message]);
        // Close the modal
        $this->closeModal();
        // Reset the form fields
        $this->resetFields();

    }

    /**
     * Dispatch an error event with the given message
     *
     * @param string $message Error message to be displayed
     */
    public function dispatchErrorEvent($message)
    {
        // Dispatch the browser event with the error message
        $this->dispatchBrowserEvent('message', ['error' => $message]);
        // Close the modal
        $this->closeModal();
    }
}
