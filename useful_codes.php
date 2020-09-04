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

User::whereDate('created_at', date('Y-m-d'));
User::whereDay('created_at', date('d'));
User::whereMonth('created_at', date('m'));
User::whereYear('created_at', date('Y'));

$localTime = $object->created_at->timezone($this->auth->user()->timezone);

//Create symbolic link for public images folder
ln -s storage/images public/images