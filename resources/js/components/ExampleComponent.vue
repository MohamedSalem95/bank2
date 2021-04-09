<template>
    <div class="">
       <p v-if="loading">
           <b class="text-muted"> 
               <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div> Fetching Currencies Please Wait ... 
            </b>
       </p>
       <div v-if="currencies.length != 0">
           <p>
               <b class="text-muted">
                   Total of 
                    <u class="text-dark "> 
                       {{ currencies.length }} 
                    </u> currency(ies) </b>
           </p>
           <table class="table table-sm table-striped table-bordered table-hover">
               <thead>
                   <th> Currency </th>
                   <th> Currency Name </th>
               </thead>

               <tbody>
                    <tr v-for="currency in currencies" :key="currency.iso" style="cursor: pointer">
                            <td> {{ currency.iso }} </td>
                            <td> {{ currency.currency_name }} </td>
                    </tr>
               </tbody>
           </table>
       </div>
           
       <p v-if="error">
           <b class="text-danger"> 
               Some error Happended please Reload Page! 
               or click 
               <a href="http://currencymaster2.herokuapp.com/currencies_list"> HERE </a>
            </b>
       </p>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                loading: false,
                currencies: [],
                error: false
            }
        },
        mounted() {
            this.loading = true
            axios.get('https://xecdapi.xe.com/v1/currencies.json?obsolete=true', {
                auth: {
                    username: 'co493817284',
                    password: 'lkbd1toj4pr99ce9gauem8nkoq'
                },
                headers: {
                    //'Access-Control-Allow-Origin': '*'
                }
            }).then(res => {
                this.loading = false
                this.currencies = res.data.currencies
                console.log(res.data.currencies)
            }).catch(err => {
                this.loading = false
                this.error = true
            })
        }
    }
</script>
