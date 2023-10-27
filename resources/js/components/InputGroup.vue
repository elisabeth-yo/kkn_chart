<template>
    <div class="position-relative mt-5">
        <label style="top: -17px;left: 12px;" :for="name"
            class="position-absolute px-2 bg-p-white font-size-16 font-weight-500 ">{{ label }} 
            <span v-if="required" class="text-danger">*</span>
        </label>
        <input :type="type" :id="name" :value="value" :placeholder="placeholder" class="form-control rounded-8 border-1 border-p-grey-56" />
    </div>
</template>

<script>
export default {
    name: "InputGroup",
    props: {
        label: {
            type: String,
            default: "Label"
        },
        type: {
            type: String,
            default: "text"
        },
        name: {
            type: String,
            default: "name"
        },
        placeholder: {
            type: String,
            default: ""
        },
        value: {
            type: String,
            default: ""
        },
        required: {
            type: Boolean,
            default: false
        }
    }
}
</script>