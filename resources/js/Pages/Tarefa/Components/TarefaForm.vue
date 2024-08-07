<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import VueTailwindDatepicker from 'vue-tailwind-datepicker';

const props = defineProps({
    tarefa: Object
})

const form = useForm({
    id: props.tarefa.id,
    nome: props.tarefa.nome || '',
    prioridade: props.tarefa.prioridade || '',
    status: props.tarefa.status || '',
    vencimento: props.tarefa.vencimento || ''
})

const emit = defineEmits(['close']);

const closeModal = () => {
    form.reset();
    emit('close');
}

const store = () => {
    form.post(route('tarefas.store'), {
        onSuccess: () => closeModal(),
    });
}

const update = () => {
    form.put(route('tarefas.update', {'tarefa': form.id}), {
        onSuccess: () => closeModal(),
    });
}

const editing = () => {
    return Object.keys(props.tarefa).length
}

</script>

<template>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ editing() ? 'Editar' : 'Criar '}} uma tarefa.
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Insira os detalhes abaixo para sua tarefa e clique em Enter para criar.
        </p>

        <div class="mt-6">
            <InputLabel for="nome" value="Nome"  />

            <TextInput
                id="nome"
                ref="nomeInput"
                v-model="form.nome"
                type="text"
                class="block w-3/4 mt-1"
                placeholder="Nome"
            />

            <InputError :message="form.errors.nome" class="mt-2" />
        </div>

        <div class="mt-6">
            <InputLabel for="status" value="Status"  />

            <select
                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                id="status"
                name="status"
                v-model="form.status"
            >
                <option>Não iniciado</option>
                <option>Em progresso</option>
                <option>Concluído</option>
            </select>

            <InputError :message="form.errors.status" class="mt-2" />
        </div>

        <div class="mt-6">
            <InputLabel for="prioridade" value="Prioridade"  />

            <select
                class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                name="prioridade"
                id="prioridade"
                v-model="form.prioridade"
            >
                <option>Baixa</option>
                <option>Média</option>
                <option>Alta</option>
            </select>

            <InputError :message="form.errors.prioridade" class="mt-2" />
        </div>

        <div class="mt-6">
            <InputLabel for="vencimento" value="Vencimento" />

            <vue-tailwind-datepicker
                as-single
                v-model="form.vencimento"
                placeholder="Vencimento"
                no-input
                name="vencimento"
            />

            <InputError :message="form.errors.vencimento" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

            <PrimaryButton
                v-if="editing()"
                class="ml-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="update"
            >
                Salvar Alterações
            </PrimaryButton>

            <PrimaryButton
                v-else
                class="ml-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="store"
            >
                Criar tarefa
            </PrimaryButton>
        </div>
    </div>
</template>
