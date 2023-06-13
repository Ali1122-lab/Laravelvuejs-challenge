<template>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <router-link class="navbar-brand mr-auto" :to="{ name: 'home' }">Home</router-link>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <router-link class="text-white" :to="{ name: 'login' }">Login</router-link>
        </li>
        <li class="nav-item">
          <router-link class="text-white ml-3" :to="{ name: 'register' }">Register</router-link>
        </li>
        <li class="nav-item">
          <router-link class="text-white ml-3" :to="{ name: 'dashboard' }">Dashboard</router-link> 
        </li>
      </ul> 
    </nav>
    <router-view></router-view>  
  </template>
  