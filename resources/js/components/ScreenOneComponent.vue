<template>
    <div class="row">
        <div class="col-md-6">
            <h5 v-if="loading">
                <div class="spinner-border spinner-border-sm text-center" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
                Loading ...
            </h5>
            <br> <br> <br> <br>
            <table vi-f="!empty" class="table table-bordered table-striped">
                <thead>
                    <th> Currency </th>
                    <th> Sell </th>
                    <th> Buy </th>
                </thead>
                <tbody>
                    <tr v-for="exchange in exchanges" :key="exchange.id">
                        <td>
                            <b> {{ exchange.from }} </b>
                        </td>

                        <td>
                            <b> {{ exchange.sell }} </b>
                        </td>

                        <td>
                            <b> {{ exchange.buy }} </b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-if="empty"> 
                <b> Please Add Some Exchanes to show here </b>
            </p>
            <p v-if="loadingError" class="text-danger">
                <b> Could Not Load The exchanes please RELOAD the page :( </b>
            </p>
        </div>
        <div class="col-md-6">
            <video width=600 height=600 src="http://www.currencydisplayscreen.com/rateinfo/upload/video/bankv_28.mp4" autoplay muted loop>
            </video>
        </div>
    </div>
</template>

<script>
let baseUrl = 'http://currencymaster2.herokuapp.com'
export default {
    data () {
        return {
            loading: false,
            loadingError: false,
            empty: false,
            exchanges: []
        }
    },
    mounted () {
        this.loading = true
        axios.get(`${baseUrl}/exchanges/exchange_list`).then(res => {
            this.loading = false
            if(res.status === 200) {
                this.exchanges = res.data.exchanges
                if(this.exchanges.length == 0) this.empty = true
            } else {
                this.loading = false
                this.loadingError = true
            }
        }).catch(err => {
            this.loading = false
            this.loadingError = true
        })
    }
}
</script>