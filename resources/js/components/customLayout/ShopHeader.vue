<template>
    <div class="jumbotron" :style="{
         backgroundImage: 'url(' + cover + ')',
         backgroundRepeat: 'no-repeat',
         backgroundSize: 'cover',
         zIndex: 0
    }">
        <div id="content" class="testo-cover text-white absolute text-center">
            <img :src="logo" class="col-3" style="padding-top: 40px;max-width:200px;"></div>
            <p class="text-center text-xl titolo-info text-white" style="padding-top: 60px;"> {{ retailerName }} </p>
            <ul id="social-icons" class="mx-auto" style="height: 30px; width: 190px; list-style: none;">
                <li style="width: 20px; height: 20px; margin-right: 15px; margin-top: 15px; fill: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        height="30" viewBox="0 0 448 448" 
                        width="30">
                        <path d="m314.375 144h-180.75l90.375 77.464844zm0 0"/>
                        <path d="m224 240c-1.910156 0-3.757812-.683594-5.207031-1.929688l-98.792969-84.679687v150.609375h208v-150.609375l-98.792969 84.679687c-1.449219 1.246094-3.296875 1.929688-5.207031 1.929688zm0 0"/>
                        <path d="m224 0c-123.710938 0-224 100.289062-224 224s100.289062 224 224 224 224-100.289062 224-224c-.140625-123.652344-100.347656-223.859375-224-224zm120 312c0 4.417969-3.582031 8-8 8h-224c-4.417969 0-8-3.582031-8-8v-176c0-4.417969 3.582031-8 8-8h224c4.417969 0 8 3.582031 8 8zm0 0"/>
                    </svg>
                </li>
                <li style="width: 20px; height: 20px; margin: 15px; fill: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-full h-auto fill-current text-white" 
                        swidth="24" 
                        height="30" 
                        viewBox="0 0 24 24">
                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3.445 17.827c-3.684 1.684-9.401-9.43-5.8-11.308l1.053-.519 1.746 3.409-1.042.513c-1.095.587 1.185 5.04 2.305 4.497l1.032-.505 1.76 3.397-1.054.516z"/>
                    </svg>                
                <li style="width: 20px; height: 20px; margin: 15px; fill: white;">
                     <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-full h-auto fill-current text-white" 
                        width="30" height="30" 
                        xmlns:xlink="http://www.w3.org/1999/xlink" 
                        version="1.1" 
                        id="Capa_1" 
                        x="0px" 
                        y="0px" 
                        viewBox="0 0 167.657 167.657" 
                        style="enable-background:new 0 0 167.657 167.657;" 
                        xml:space="preserve">
                        <path d="M83.829,0.349C37.532,0.349,0,37.881,0,84.178c0,41.523,30.222,75.911,69.848,82.57v-65.081H49.626   v-23.42h20.222V60.978c0-20.037,12.238-30.956,30.115-30.956c8.562,0,15.92,0.638,18.056,0.919v20.944l-12.399,0.006   c-9.72,0-11.594,4.618-11.594,11.397v14.947h23.193l-3.025,23.42H94.026v65.653c41.476-5.048,73.631-40.312,73.631-83.154   C167.657,37.881,130.125,0.349,83.829,0.349z"/>
                    </svg>
                </li>
            </ul>
    </div>
</template>

<script>
export default {
    name: 'ShopHeader',
    props: [
        'cover',
        'logo',
        'retailerName'
    ]
}
</script>

<style scoped>
.jumbotron {
    width: 100%; 
    height: 100vh; 
    margin: 0 auto;
}
.content {
    top: 0; left: 0; 
    height: 100%; width:100%;
    z-index: 0;
}
</style>