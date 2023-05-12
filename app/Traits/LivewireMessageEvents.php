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
    * This PHP function dispatches a browser event with a success message.
    * @param message The message parameter is a string that represents the success message that will be
    * sent to the browser event.
    */
    public function dispatchSuccessNoModalEvent($message)
    {
        // Dispatch the browser event with the success message
        $this->dispatchBrowserEvent('message', ['success' => $message]);
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

    /**
     * This PHP function dispatches a browser event with an error message.
     * @param message The error message that will be sent to the browser event.
     */
    public function dispatchErrorNoModalEvent($message)
    {
        // Dispatch the browser event with the error message
        $this->dispatchBrowserEvent('message', ['error' => $message]);
    }
}
