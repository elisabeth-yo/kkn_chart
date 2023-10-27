<template>

</template>

<script>
import Hero from "@/components/Hero.vue";
import InputGroup from "@/components/InputGroup.vue";
import SelectGroup from "@/components/SelectGroup.vue";
import axios from "axios";

export default {
    components: {
        Hero,
        InputGroup,
        SelectGroup,
    },
    name: "Inquiry",
    data() {
        return {
            countries: [],
            options: [],
            loading: false,
        }
    },
    methods: {
        async getDataCountries() {
            try {
                this.loading = true;
                const response = await axios.post('https://countriesnow.space/api/v0.1/countries/positions/range', {
                    "type": "long",
                    "min": 1,
                    "max": 200
                });

                this.options = response?.data?.data?.map((item) => {
                    return {
                        value: item?.iso2,
                        text: item?.name
                    }
                });

            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
        this.getDataCountries();
    }
}
</script>
