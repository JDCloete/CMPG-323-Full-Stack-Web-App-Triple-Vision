<template>
    <dialog-baseline
        v-model="dialog"
        :loading="loading"
        @primaryButtonClicked="saveStudent"
        @secondaryButtonClicked="closeDialog">
        <template #toolbar-icon>
            mdi-shield-account
        </template>

        <template #toolbar-title>
            Student Form
        </template>

        <template #dialog-content>
            <v-form ref="studentForm" @submit.prevent>
                <v-row>
                    <v-col cols="6">
                        <!-- First Name -->
                        <div class="text-field-label">
                            Name
                        </div>
                        <v-text-field
                            v-model="student.first_name"
                            :readonly="loading"
                            :rules="[rules.required]"
                            variant="solo"
                            density="compact"
                        ></v-text-field>
                    </v-col>

                    <v-col cols="6">
                        <!-- Surname -->
                        <div class="text-field-label">
                            Surname
                        </div>
                        <v-text-field
                            v-model="student.last_name"
                            :readonly="loading"
                            :rules="[rules.required]"
                            variant="solo"
                            density="compact"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12">
                        <!-- Email -->
                        <div class="text-field-label">
                            Email
                        </div>
                        <v-text-field
                            v-model="student.email"
                            :readonly="loading"
                            :rules="[rules.required, rules.email]"
                            variant="solo"
                            density="compact"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12">
                        <!-- Student Number -->
                        <div class="text-field-label">
                            Student Number
                        </div>
                        <v-text-field
                            v-model="student.studentNumber"
                            :readonly="loading"
                            :rules="[rules.required]"
                            variant="solo"
                            density="compact"
                        ></v-text-field>
                    </v-col>
                </v-row>
            </v-form>
        </template>

        <template #primary-button-text>
            Save
        </template>

        <template #secondary-button-text>
            Close
        </template>

    </dialog-baseline>
</template>

<script>

import { useForm } from "@inertiajs/vue3";
import BaselineDialog from "@/Components/BaselineDialog.vue";
import DialogBaseline from "@/Components/BaselineDialog.vue";

export default {
    name: "StudentFormDialog",
    components: {DialogBaseline, BaselineDialog },
    props: {
        loading: {
            required: false,
            default: false,
        },
        student: {
            required: false,
            default: {
                first_name: '',
                last_name: '',
                email: '',
                role: '',
            }
        },
        isUpdate: {
            required: true,
        }
    },
    data: () => ({
        dialog: true,
        rules: {
            required: (value) => !!value || "Required.",
            email: (value) => /.+@.+\..+/.test(value) || "Invalid email address.",
            phone: (value) => /^\+?\d{10,15}$/.test(value) || "Invalid phone number.",
        },
    }),
    methods: {
        async saveStudent() {
            const { valid } = await this.$refs.studentForm.validate();
            if (valid) {
                if(this.isUpdate) {
                    this.$emit("editStudent", this.student);
                }
                else {
                    this.$emit("saveStudent", this.student);
                }
            }
        },
        closeDialog() {
            this.$emit("closeDialog");
        },
    },
};
</script>

<style scoped>

</style>
