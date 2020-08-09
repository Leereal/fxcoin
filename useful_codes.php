//Image view in blade 
<img src="/storage/images/{{$product->image}}">;
<?
return Carbon::now()->addHours(24)->format('Y-m-d H:00:00');

fetch('https://api.ipify.org?format=json')
.then(x => x.json())
.then(({ ip }) => {
    this.term = ip;
});

//Grab URL Ref
${this.$route.params.ref}

//Create serve 
php artisan serve --host=192.168.0.108 --port=80