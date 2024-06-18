<div>
    <!-- {{-- Success is as dangerous as failure. --}} -->
    <form method="post" wire:submit.prevent="UpdateDetails()">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="name" wire:model='name'>
                <span class="text-danger"> @error('name') {{ $message ?? null}} @enderror </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="username" wire:model='username'>
                <span class="text-danger"> @error('username') {{ $message ?? null}} @enderror </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" name="example-text-input" placeholder="email" disable wire:model='email'>
                <span class="text-danger"> @error('email') {{ $message ?? null}} @enderror </span>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Biography</label>
            <textarea class="form-control" name="example-textarea-input" rows="6" placeholder="Content.." wire:model='biography'>Biography...
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary" >Save Changes</button>
    </form>
</div>
