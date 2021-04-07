@props(['show'=>false,'type'=>'error','types'=>['error'=>'red','success'=>'green']])

<div  {{$attributes->merge(['class'=> "bg-{$types[$type]}-400 text-{$types[$type]}-900"
      .' rounded-lg w-1/4 px-8 py-4 fixed bottom-10 right-10'])}}
      x-data="data()" x-show="show" >

    <div class="flex justify-between items-center">
        <div>{{$slot}}</div>
        <span @click="hidenow()" class="cursor-pointer text-2xl rounded-full h-8 text-center w-8 hover:bg-{{$types[$type]}}-500">&times;</span>
    </div>

</div>

<script>
    let data=()=>{
        return{
            show: false,
            hidenow(){ this.show=false},
            appear(){
                this.show=true;
                setTimeout(()=>this.show=false,5000)
            }
        }
    }
</script>
{{--using it--}}
{{--<flash type='error/success'>--}}
{{--    flashMessage--}}
{{--</flash>--}}
