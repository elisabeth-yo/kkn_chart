<template>
    <div class="position-relative mt-5">
        <label style="top: -17px;left: 12px;" :for="name"
            class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 ">{{ label }}
            <span v-if="required" class="text-danger">*</span>
        </label>
        <select :name="name" :id="name" class="form-control rounded-8 border-1 border-p-grey-56">
            <option value="">Select {{ name }}</option>
            <option v-for="option in options" :value="option.value">{{ option.label }}</option>
        </select>
        <div style="position: absolute;top: 15%;left: 85%;">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 9l6 6l6 -6"></path>
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    name: "SelectGroup",
    props: {
        label: {
            type: String,
            default: "Label"
        },
        name: {
            type: String,
            default: "name"
        },
        placeholder: {
            type: String,
            default: ""
        },
        required: {
            type: Boolean,
            default: false
        },
        options: {
            type: Array,
            default: []
        }
    }
}
</script>