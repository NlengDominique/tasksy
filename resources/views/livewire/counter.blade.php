<div style="text-align: center">
    <button wire:click="increment">+</button>
    <h1>{{$count}}</h1>
    <input type="text" wire:model.live="message">
    <p style="background: red">{{$message}}</p>
</div>
