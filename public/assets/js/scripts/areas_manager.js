import {get, postJson } from "../modules/http.js";
new Vue({
    el: "#App",
    data() {
        return {
            error: null,
            result: null,
            isLoading: false,
            pristine: null,
            sites: [],
            selectedAreas: [],
            search: '',
            load_id: '',
            delete_id: '',
            form: {
                id: '',
                name: '',
                code: '',
                adresse: '',
                phone: '',

                areas: [{
                    libelle: ''
                }]
            }
        };
    },

    mounted() {
        // Une fois que Vue.js est chargé, on cache le loader
        document.getElementById('loader').style.display = 'none';

        //init pristine
        if (document.querySelector(".form-site") !== null) {
            this.pristine = new Pristine(document.querySelector(".form-site"), {
                classTo: "input-form",
                errorClass: "has-error",
                errorTextParent: "input-form",
                errorTextClass: "text-danger mt-2"
            });
        }
        this.viewAllSites();
    },

    methods: {

        createSite(event) {
            const isValid = this.pristine.validate();
            if (isValid) {
                const url = event.target.getAttribute("action");
                this.isLoading = true;
                postJson(url, this.form)
                    .then(({ data, status }) => {
                        this.isLoading = false;
                        // Gestion des erreurs
                        if (data.errors !== undefined) {
                            this.error = data.errors.toString();
                            setTimeout(() => {
                                new Toastify({
                                    node: $("#failed-notification-content").clone().removeClass("hidden")[0],
                                    duration: 3000,
                                    newWindow: true,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    stopOnFocus: true
                                }).showToast();
                            }, 100)
                        }
                        if (data.result) {
                            this.error = null;
                            console.log(data.result);
                            this.result = data.result;
                            new Toastify({
                                node: $("#success-notification-content").clone().removeClass("hidden")[0],
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true
                            }).showToast();
                            if (this.form.id !== "") {
                                this.viewAllSites();
                            }
                            // clean fields
                            setTimeout(() => {
                                this.reset();
                            }, 100);
                        }
                    })
                    .catch((err) => {
                        this.isLoading = false;
                        this.error = err;
                        console.log(err);
                    });
            }

        },

        reset() {
            this.form = {
                name: '',
                code: '',
                adresse: '',
                phone: '',
                areas: [{
                    libelle: ''
                }]
            }
            document.getElementById('btn-reset').click();
            /* const myModal = tailwind.Modal.getInstance(document.querySelector("#modal-add-on"));
            myModal.hide(); */
        },

        viewAllSites() {
            get("/sites")
                .then((res) => {
                    this.sites = res.data.sites;
                })
                .catch((err) => console.log("error"));
        },
        deleteArea(id) {
            let self = this;
            this.load_id = id;
            postJson("/delete", {
                    table: 'areas',
                    id: id
                })
                .then((res) => {
                    const index = this.selectedAreas.findIndex(objet => objet.id === id);
                    if (index !== -1) {
                        this.selectedAreas.splice(index, 1);
                    }
                    self.viewAllSites();
                    self.load_id = "";
                })
                .catch((err) => {
                    self.load_id = "";
                });


        },


    },


    computed: {
        allSites() {
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