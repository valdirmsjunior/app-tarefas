<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import TableRow from "@/Pages/Tarefa/Components/TableRow.vue";
import TarefaForm from "@/Pages/Tarefa/Components/TarefaForm.vue";
import {ref} from "vue";
import Modal from '@/Components/Modal.vue';
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const form = useForm({});
const showFormModal = ref(false);
const showDeleteConfirmationModal = ref(false);
const selectedTarefa = ref(null);

defineProps({
    tarefas: Object
})

const openFormModal = (tarefa) => {
    selectedTarefa.value = tarefa;
    showFormModal.value = true;
}

const closeFormModal = () => {
    showFormModal.value = false;
    selectedTarefa.value = null;
    form.reset();
};

const openDeleteConfirmationModal = (tarefa) => {
    selectedTarefa.value = tarefa;
    showDeleteConfirmationModal.value = true;
}

const closeDeleteConfirmationModal = () => {
    showDeleteConfirmationModal.value = false;
    selectedTarefa.value = null;
};

const deleteTarefa = () => {
    form.delete(route('tarefas.destroy', {'tarefa': selectedTarefa.value.id}))
    closeDeleteConfirmationModal()
}

</script>

<template>
    <Head title="Tarefas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Tarefas</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="pt-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-lg font-medium text-gray-900">Tarefas</h1>
                                <p class="mt-1 text-sm text-gray-600">
                                    Uma lista de todas as suas tarefas com nome, status, prioridade e data de vencimento.</p>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <PrimaryButton @click="openFormModal({})">Adicionar Tarefa</PrimaryButton>
                            </div>
                        </div>
                        <div class="flow-root mt-8">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-0 w-1/2">Nome</th>
                                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Prioridade</th>
                                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Status</th>
                                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Data de Vencimento</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                    <span class="sr-only">Editar</span>
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                    <span class="sr-only">Deletar</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            <table-row
                                                v-for="tarefa in tarefas"
                                                :key="tarefa.id"
                                                :tarefa="tarefa"
                                                @editClicked="openFormModal(tarefa)"
                                                @deleteClicked="openDeleteConfirmationModal(tarefa)"
                                            />
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="showFormModal">
            <TarefaForm :tarefa="selectedTarefa" @close="closeFormModal"/>
        </Modal>
        <Modal :show="showDeleteConfirmationModal" @close="closeDeleteConfirmationModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Você deseja Deletar esta Tarefa?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Depois que sua tarefa for excluída, todos os seus dados serão excluídos permanentemente. Por favor
                    clique no botão excluir para confirmar.
                </p>

                <div class="flex justify-end mt-6">
                    <SecondaryButton @click="closeDeleteConfirmationModal"> Cancelar </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteTarefa"
                    >
                        Deletar Tarefa
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
