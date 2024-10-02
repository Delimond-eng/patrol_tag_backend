import {get, postJson } from "../modules/http.js";
new Vue({
    el: "#App",
    data() {
        return {
            error: null,
            result: null,
            isLoading: false,
            pendingScans: []
        };
    },

    mounted() {
        // Une fois que Vue.js est chargé, on cache le loader
        document.getElementById('loader').style.display = 'none';
    },

    methods: {
        viewAllPendingScans() {
            get("/pending.scans")
                .then((res) => {
                    this.pending_scans = res.data.pendingScans;
                })
                .catch((err) => console.log("error"));
        },
    },


    computed: {
        allPendingScans() {
            if (this.search && this.search.trim()) {
                return this.sites.filter((el) =>
                    el.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase()) || el.code
                    .toLowerCase()
                    .includes(this.search.toLowerCase())
                );
            } else {
                return this.sites;
            }
        }
    }
});