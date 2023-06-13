<template>
    <div class="container"> 
    <div class="class-row justify-content-center"> 
    <div class="col-sm6 mt-4">
      <h2> Register</h2> 
        <p class="text-danger" v-for="error in errors" :key="error">  </p>

        <span v-for="err in errors" :key="err">  </span> 
          
            <form @submit.prevent="register">
                <div class="form-group">
                    <label for="name">name:</label> 
                    <input type="email" class="form-control" id="name" v-model="form.name">   
                </div> 
                <div class="form-group">
                    <label for="email">mail address:</label> 
                    <input type="email" class="form-control" id="email" v-model="form.email">   
                </div> 
                <div class="form-group">
                    <label for="password">password:</label>
                    <input type="password" class="form-control" id="password" v-model="form.password">   
                </div>
                <div class="form-group">
                    <label for="c_password">confirm password:</label>
                    <input type="c_password" class="form-control" id="c_password" v-model="form.c_password">   
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
            const router = useRouter
            let form = reactive({
                name:'',
                email:'',
                password:'',
                c_password:''
            });
            let errors = ref([])
            const register = async() =>{
                await axios.post('/api/register' ,form  ).then(res=>{
                       if(res.data.succes){
                         localStorage.setItem('token',res.data.data.token)
                         router.push({name:'dashboard'})
    
                       } 
    
                }).catch(e=>{
                     errors.value= e.response.data.massage

                })
            }
            return {
                form,
                register,
                login
    
            }
        },
    }
    </script>
    
    
    
    
        
    
    
      