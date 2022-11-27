<script>
export default {
    name: 'FormInput',
    inheritAttrs: false
}
</script>
<script setup>
import { onMounted, ref } from 'vue';
import { v4 as uuid } from 'uuid'
import VaLabel from "@/views/components/form/label.vue";

const props = defineProps({
    modelValue: [Number, String, Array],
    label: {
        type: String
    },
    error: String,
    placeholder: String,
    autocomplete: {
        type: String,
        default: 'off',
    },
    hint: String,
    type: {
        type: String,
        default: 'text',
    },
    id: {
        type: String,
        default() {
            return `text-input-${uuid()}`
        },
    },
    required:{
        type: Boolean,
        default: false
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <div>
        <VaLabel :required="required" :for="id">
            <slot name="label">{{label??''}}</slot>
        </VaLabel>
        <div class="input-group input-group-flat">
            <input :id="id"
                   ref="input"
                   v-bind="$attrs"
                   class="form-control"
                   :class="{'is-invalid': error}"
                   :placeholder="placeholder"
                   :autocomplete="autocomplete"
                   :type="type"
                   :required="required"
                   :value="modelValue"
                   @input="$emit('update:modelValue', $event.target.value)"/>
            <span class="input-group-text p-0"  :class="{'border-danger':error}">
                <slot name="input-right"></slot>
            </span>
        </div>
        <div class="invalid-feedback" :class="{'d-block ': error}">{{error}}</div>
    </div>
</template>
