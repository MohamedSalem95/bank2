<template>
    <div>
        <p> Works </p>
    </div>
</template>

<script>
let baseUrl = 'http://currencymaster2.herokuapp.com'
    export default {
        data () {
            return {
                loading: false,
                exchanges: [],
                error: false
            }
        },
        mounted() {
            this.loading = true
            axios.get(`${baseUrl}/exchanges/exchange_list`).then(res => {
                this.loading = false
                this.exchanges = res.data.exchanges
            }).catch(err => {
                this.loading = false
                this.error = true
            })
        }
    }
</script>
