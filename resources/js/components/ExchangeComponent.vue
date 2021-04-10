<template>
    <div class="row">
        <div class="col">
           <form @submit="submitForm($event)" method="post">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th> From </th>
                        <th> To </th>
                        <th> Rate </th>

                        <th> Sell </th>
                        <th> Buy </th>
                        <th></th>
                    </thead>

                    <tr>
                        <td>
                             
                            <select name="from" id="" v-model="from" class="form-control d-inline" @change="fromChanged()">
                                <option value="" selected> -- Select Currency -- </option>
                                <option v-for="currency in currencies" :key="currency.id" class="font-weight-bold"> {{ currency.iso }} </option>
                                <div>
                                    <strong class="text-danger"> {{ fieldErrors.from }} </strong>
                                </div>
                            </select>
                        </td>

                         <td>
                             <!--
                            <select name="to" id="" v-model="to" class="form-control d-inline" @change="toChanged()">
                                <option value="" selected> -- Select Currency -- </option>
                                <option v-for="currency in currencies" :key="currency.id" class="font-weight-bold"> {{ currency.iso }} </option>
                                <div>
                                    <strong class="text-danger"> {{ fieldErrors.to }} </strong>
                                </div>
                            </select> -->
                            EGP
                        </td>

                        <td>
                            <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                            </div>
                            <b v-if="error" class="text-danger"> Error </b>
                            <b v-if="rate != 0"> {{ this.rate }} </b>
                            <div>
                                    <strong class="text-danger"> {{ fieldErrors.rate }} </strong>
                                </div>
                        </td>

                        <td>
                            <input style="width: 100px" type="text" name="sellMargin" id="" v-model="sellMargin" class="form-control d-inline">
                            <b> {{ sell }} </b>
                            <div>
                                    <strong class="text-danger"> {{ fieldErrors.sellMargin }} </strong>
                                </div>
                        </td>
                        <td>
                            <input style="width: 100px" type="text" name="buyMargin" id="" v-model="buyMargin" class="form-control d-inline">
                            <b> {{ buy }} </b>
                            <div>
                                    <strong class="text-danger"> {{ fieldErrors.buyMargin }} </strong>
                                </div>
                        </td>

                        <td>
                            <button v-if="!saving" class="btn btn-success"> Save </button>
                            <button v-if="saving" class="btn btn-success" disabled>
                                <div class="spinner-border spinner-border-sm text-center" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Saving
                            </button>
                        </td>

                        
                    </tr>
                </table>
           </form>
           <p v-if="success">
               <b class="text-success"> Exchange Saved Successfully. </b>
           </p>
           <p v-if="savingError">
               <b class="text-danger"> Error Exhange Not Saved Please Try Again. </b>
           </p>
           <p v-if="validationError">
               <b class="text-danger"> Error Data Not Valid Please Enter Valid Data. </b>
           </p>


           <div>
                <hr>
                <h4> Latest Added </h4>
                <h5 v-if="loadingLatest" class="text-center">
                    <div class="spinner-border spinner-border-sm text-center" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Loading latest exchanes..
                </h5>
                
                <table class="table table-sm table-bordered">
                    <thead>
                        <th> From </th>
                        <th> To </th>
                        <th> Sell </th>
                        <th> Buy </th>
                        <th> Date Added </th>
                    </thead>
                    <tbody>
                        <tr v-for="exchange in latestExchanges" :key="exchange.id" v-bind:class="{ 'bg-info': exchange.new }">
                            <td> {{ exchange.from }} </td>
                            <td> {{ exchange.to }} </td>
                            <td> {{ exchange.sell }} </td>
                            <td> {{ exchange.buy }} </td>
                            <td> 
                                {{ exchange.created_at | moment("DD/MM/YYYY, h:mm:ss a") }} 
                                __<span class="font-weight-bold"> {{ exchange.created_at | moment('from') }} </span>__ 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>


    </div>
</template>

<script>
let baseUrl = 'http://currencymaster2.herokuapp.com'
    export default {
        data () {
            return {
                loading: false,
                loadingLatest: false,
                saving: false,
                currencies: [],
                latestExchanges: [],
                from: '',
                to: 'EGP',
                rate: 0,
                error: false,
                sellMargin: 0,
                buyMargin: 0,
                success: false,
                savingError: false,
                validationError: false,
                fieldErrors: {
                    from: '',
                    to: '',
                    rate: '',
                    sellMargin: '',
                    buyMargin: ''
                }
            }
        },
        methods: {
            fromChanged() {
                this.rate = 0
                this.loading = true
                this.error = false
                axios.get(
                    `https://xecdapi.xe.com/v1/convert_from.json/?from=${this.from}&to=EGP&amount=1`,
                    { auth: { username: 'co493817284', password: 'lkbd1toj4pr99ce9gauem8nkoq' },
                    headers: { 'Cross-Origin': true } }
                ).then(res => {
                    this.loading = false
                    // this.error = false
                    this.rate = parseFloat(res.data.to[0].mid)
                    // console.log(res.data)
                }).catch(err => {
                    this.loading = false
                    this.rate = 0
                    this.error = true
                    console.log('Error', err)
                })
            },
            submitForm(event) {
                event.preventDefault()
                
                let exchangeData = { 
                    from: this.from,
                    to: this.to,
                    rate: this.rate,
                    sell: this.sell,
                    buy: this.buy,
                    sell_margin: parseFloat(this.sellMargin),
                    buy_margin: parseFloat(this.buyMargin)
                }
                this.fieldErrors = this.validateForm(exchangeData)
                if(Object.keys(this.fieldErrors).length) return
                this.saving = true
                axios.post(`${baseUrl}/exchanges`, exchangeData).then(res => {
                    if(res.status === 200){
                        // console.log('done')
                        this.success = true
                        this.saving = false
                        this.clearForm()
                        let newExchange = res.data.exchange
                        newExchange.new = true
                        this.latestExchanges.splice(0, 0, newExchange)
                        setTimeout(() => { this.success = false }, 3000)
                    } else if( res.status == 400 || res.status == 422 ) {
                        this.validationError = true
                        this.saving = false
                        setTimeout(() => { this.validationError = false }, 3000)
                    } else {
                        this.savingError = true
                        this.saving = false
                        setTimeout(() => { this.savingError = false }, 3000)
                    }
                }).catch(err => {
                    this.savingError = true
                    this.saving = false
                    setTimeout(() => { this.savingError = false }, 3000)
                })
            },
            validateForm(fields) {
                let errors = {}
                if(fields.from === '') errors.from = 'Please choose'
                if(fields.to === '') errors.to = 'Please choose'
                if(fields.rate === 0) errors.rate = 'Invalid Rate'
                //if(fields.sellMargin === '') errors.sellMargin = 'Please enter valid margin'
                //if(fields.buyMargin === 'null') errors.buyMargin = 'Please enter valid margin'
                return errors
            },
            clearForm() {
                this.from = ''
                this.to = ''
                this.rate = 0
                this.sellMargin = 0
                this.buyMargin = 0
            }
        },
        mounted() {
            this.loadingLatest = true
            axios.get(`${baseUrl}/currency_list_json`).then(res => {
                this.currencies = res.data.currencies
                
               
                // console.log(this.currencies)
            })
             axios.get(`${baseUrl}/exchanges/exchange_list`).then(res => {
                console.log('i got here')
                this.loadingLatest = false
                this.latestExchanges = res.data.exchanges
            }).catch(err => {
                this.loadingLatest = false
            })
        },
        computed: {
            sell () {
                // console.log(typeof(this.sellMargin))
                // console.log(typeof(this.rate))
                return this.rate + parseFloat(this.sellMargin)
            },
            buy () {
                return this.rate + parseFloat(this.buyMargin)
            }
        }
    }
</script>
