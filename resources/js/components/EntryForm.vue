<template>
   <form @submit.prevent= "submit()">
        <div class= "form-group">
            <div class= "row m-5 form-group">
                
                <div class= "col-sm-3"> </div>
                <div class= "col-sm-6">
                    <h3 class= "m-5"> <b>Add New Entry </b></h3>
                    <div v-bind:class="{error: errors.first_name}">
                        <label>First Name </label>
                        <input type= "text" name= "first_name" class= "form-control "  @keypress="isCharacter($event)" v-model="entry.first_name"  v-on:input="clearError('first_name')" >
                        <div class="form-element" v-if="errors.first_name">
                            <p>{{ errors.first_name[0] }}</p>
                        </div>
                    </div>

                    <div class="mt-2" v-bind:class="{error: errors.last_name}">
                        <label>Last Name </label>
                        <input type= "text" name= "last_name" class= " form-control" v-model="entry.last_name" v-on:input="clearError('last_name')">
                        <div class="form-element" v-if="errors.last_name">
                            <p>{{ errors.last_name[0] }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-2" v-bind:class="{error: errors.title}">
                        <label>Title </label>
                        <input type= "text" name= "title" class= " form-control" v-model="entry.title" v-on:input="clearError('title')"> 
                        <div class="form-element" v-if="errors.title">
                            <p>{{ errors.title[0] }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-2" v-bind:class="{error: errors.business_name}">
                        <label> Business Name </label>
                        <input type= "text" name= "business_name" class= " form-control" v-model="entry.business_name" v-on:input="clearError('business_name')">
                        <div class="form-element" v-if="errors.business_name">
                            <p>{{ errors.business_name[0] }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-2" v-bind:class="{error: errors.type_of_operation}">
                        <label>Type of Operation </label>
                        <input type= "text" name= "type_of_operation" class= " form-control" v-model="entry.type_of_operation" v-on:input="clearError('type_of_operation')"> 
                        <div class="form-element" v-if="errors.type_of_operation">
                            <p>{{ errors.type_of_operation[0] }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-2" v-bind:class="{error: errors.distributor_name}">
                        <label> Distributor Name </label> 
                        <input type="text" name= "distributor_name" class= " form-control" v-model="entry.distributor_name" v-on:input="clearError('distributor_name')">
                        <div class="form-element" v-if="errors.distributor_name">
                            <p>{{ errors.distributor_name[0] }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-2" v-bind:class="{error: errors.email}">
                        <label> Email </label>
                        <input type= "text" name= "email" class= " form-control" v-model="entry.email" v-on:input="clearError('email')"> 
                        <div class="form-element" v-if="errors.email">
                            <p>{{ errors.email[0] }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-2 mb-2" v-bind:class="{error: errors.phone_number}">
                        <label> Phone Number </label>
                        <input type= "text" name= "phone_number" class= " form-control" v-model="entry.phone_number"  @keypress="isNumber($event)" v-on:input="clearError('phone_number')">
                        <div class="form-element" v-if="errors.phone_number">
                            <p>{{ errors.phone_number[0] }}</p>
                        </div> 
                    </div>
                    <label class= "terms mb-2"> Terms & Conditions </label>
                    <div v-bind:class="{error: errors.terms_and_conditions}">
                        <input type="checkbox" class="form-check-input" name="terms_and_conditions" value="1" v-model="entry.terms_and_conditions" v-on:input= "clearError('terms_and_conditions')" >
                        <label class="form-check-label" for="exampleCheck1"> I agree to the official contest rules.</label> <br>
                        <div class="form-element" v-if="errors.terms_and_conditions">
                            <p>{{ errors.terms_and_conditions[0] }}</p>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input"  name= "optin" value="1" v-model="entry.optin">
                        <label class="form-check-label" for="exampleCheck1"> Yes,I would like to recieve future communications via emails .</label>
                    </div>
                    <button  type="submit" class="btn btn-success button"><b>SUBMIT ENTRY</b></button>
                        
                </div>
                <div class= "col-sm-3"> </div> 
            </div> 
    </div>
   </form>
</template>
<script>
export default {
    name: 'EntryForm',
    data() {
        return {
             entry:{
                    first_name:'',
                    last_name: '',
                    title: '',
                    business_name: '',
                    type_of_operation: '',
                    distributor_name: '',
                    email: '',
                    phone_number: '',
                    terms_and_conditions:0,
                    optin: '',
                    errors:[],
                },
                    isSubmitting: false,
                    errors: {},
                    
        }
    },
    methods: {
        submit(){
            let that = this;

            if (that.isSubmitting) {
                return;
            }

            that.isSubmitting = true;
            that.clearAllErrors();
            that.isSuccessful   = false;
       
            
            console.log('submit');
            console.log(this.entry);
           
    
            axios.post('/store',this.entry).then((response) => {
                if (response.data.status === "success") {
                    that.entry = {
                        first_name:'',
                        last_name: '',
                        title: '',
                        business_name: '',
                        type_of_operation: '',
                        distributor_name: '',
                        email: '',
                        phone_number: '',
                        terms_and_conditions:0,
                        optin: '',
                        errors:[],
                      
                        
                    };
                    alert('Saved');
                }   else {
                        that.errors = { error: [response.data.message]};
                    }
                   
                    that.isSubmitting = false;
                   
            },  
            (error) => {
                if (error.response.status === 422) {
                    that.errors = error.response.data.errors;
                    
                } else {
                        that.errors = {
                            error: ["An error occurred, please try again later."],
                        };
                    }
                that.isSubmitting = false;
            });
            
        
  
        }, 
        isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        },
        isCharacter(evt) {


        },
        clearError(key) {
            this.errors.error = '';
            this.errors[key] = '';
         },

        clearAllErrors() {
            this.errors = {
                
            };
            this.successMessage = '';
        },
        
    }
}
</script>

<style scoped>
.form-element{
    color:red;
}
</style>