<div>
    <form action="#" class="invoice-repeater">
        <div class="d-flex">
            <div data-repeater-list="invoice" class="flex-grow-1">
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" name="name" aria-describedby="name" value="Turn on Wifi" />
                        </div>
                        <button type="button" class="btn btn-danger ms-2 " data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" name="name" aria-describedby="name"
                                placeholder="Open internet browser" value="Open internet browser" />
                        </div>
                        <button type="button" class="btn btn-danger ms-2 " data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
                <div data-repeater-item>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" name="name" aria-describedby="name"
                                placeholder="Input username password" value="Input username password" />
                        </div>
                        <button type="button" class="btn btn-danger ms-2 " data-repeater-delete>
                            <i data-feather="x" class="me-25"></i>
                            <span><i class="fas fa-trash"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-icon btn-primary " data-repeater-create>
            <i data-feather="plus"></i>
            <span><i class="fas fa-plus"></i></span>
        </button>
    </form>
</div>

@push('scripts')
<script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
<script>
    $('.invoice-repeater, .repeater-default').repeater({
        // isFirstItemUndeletable: true,
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });
</script>
@endpush
