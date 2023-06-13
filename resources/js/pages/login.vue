<template>
<div class="container"> 
<div class="class-row justify-content-center"> 
<div class="col-sm6 mt-4">

    <p class="text-danger" v-if="errorf">{{ error }}</p>
      
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="email">mail address:</label> 
                <input type="email" class="form-control" id="email" v-model="form.email">   
            </div> 
            <div class="form-group">
                <label for="password">password:</label>
                <input type="password" class="form-control" id="password" v-model="form.password">   
            </div>
            <button type="submit" class="btn btn-primary" >Login</button> 
    </form>
</div>
</div>  
</div>
</template>

<script>
import {reactive ,ref } from 'vue'
import { useRouter } from 'vue-router';
export default{

    setup() {
        const router = useRouter()
        let form = reactive({
            email:'',
            password:''
        });
        let error = ref('')
        const login = async() =>{
            await axios.post('/api/login' ,form  ).then(res=>{
                console.log('res', res);
                   if(res.data.success){
                    console.log('yes logged in');
                     localStorage.setItem('token',res.data.data.token)
                     router.push({name:'dashboard'})

                   } else{
                           error.value = res.data.massage
                    
                   }

            })
        }
        return {
            form,
            login

        }
    },
}
</script>




    


  