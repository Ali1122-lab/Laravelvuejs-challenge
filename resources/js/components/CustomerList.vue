<template>
    <div>
      <h1 class="text-center">Customer List</h1>
      <div>
        <input type="text" v-model="searchQuery" placeholder="Search by email or last name" />
        <button @click="search">Search</button>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th @click="sortBy('id')">ID</th>
            <th @click="sortBy('first_name')">First Name</th>
            <th @click="sortBy('email')">Email</th>
            <th @click="sortBy('last_name')">Last Name</th>
            <th @click="sortBy('gender')">Gender</th>
            <th @click="sortBy('points')">Points</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in sortedCustomers" :key="customer.id">
            <td>{{ customer.id }}</td>
            <td>{{ customer.first_name }}</td>
            <td>{{ customer.email }}</td>
            <td>{{ customer.last_name }}</td>
            <td>{{ customer.gender }}</td>
            <td>{{ customer.points }}</td>
            <td>
              <button @click="promote(customer)" class="btn btn-sm btn-primary">Promote</button>
              <button @click="demote(customer)" class="btn btn-sm ml-3 btn-danger">Demote</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import { ref, computed, onMounted } from 'vue';
  import axios from 'axios';
  
  export default {
    setup() {
      const customers = ref([]);
      const searchQuery = ref('');
      const sortKey = ref('points');
      const sortDesc = ref(true);
  
      const fetchCustomers = async () => {
        try {
          const response = await axios.get('/api/customers');
          customers.value = response.data.customers;
          console.log('customers', response.data.customers);
        } catch (error) {
          console.error(error);
        }
      };
  
      onMounted(fetchCustomers);
  
      const filteredCustomers = computed(() => {
        const query = searchQuery.value.toLowerCase().trim();
        if (query) {
          return customers.value.filter(
            (customer) =>
              customer.email.toLowerCase().includes(query) ||
              customer.last_name.toLowerCase().includes(query)
          );
        }
        return customers.value;
      });
  
      const sortedCustomers = computed(() => {
        const sorted = filteredCustomers.value.slice();
        
        return sorted;
      });
  
      const promote = async (customer) => {
        try {
          const response = await axios.put(`/api/customers/${customer.id}/promote`);
          console.log('resp', response);
          console.log('customer', customer);
          if (response.status === 200) {
            if (customer.gender === 'Male') {
              customer.points += 10;
            } else if (customer.gender === 'Female') {
              customer.points += 5;
            }
          }
        } catch (error) {
          console.error(error);
        }
      };
  
      const demote = async (customer) => {
        try {
          const response = await axios.put(`/api/customers/${customer.id}/demote`);
          if (response.status === 200) {
            if (customer.gender === 'Male') {
              customer.points -= 5;
            } else if (customer.gender === 'Female') {
              customer.points -= 2;
            }
          }
        } catch (error) {
          console.error(error);
        }
      };
  
      const search = async () => {
        try {
          const response = await axios.get(`/api/customers?query=${searchQuery.value}`);
          customers.value = response.data;
        } catch (error) {
          console.error(error);
        }
      };
  
      const sortBy = (key) => {
        if (key === sortKey.value) {
          sortDesc.value = !sortDesc.value; 
        } else {
          sortKey.value = key;
          sortDesc.value = true;
        }
      };
  
      return {
        searchQuery,
        sortedCustomers,
        promote,
        demote,
        search,
        sortBy,
      };
    },
  };
  </script>
  