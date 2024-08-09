<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Red from "@/Components/Badges/Red.vue";
import Yellow from "@/Components/Badges/Yellow.vue";
import Green from "@/Components/Badges/Green.vue";
import DangerButton from "@/Components/DangerButton.vue";
import moment from "moment";

const props = defineProps({
    tarefa: Object
})

const emit = defineEmits(['editClicked', 'deleteClicked'])

const handleEditClick = () => {
    emit('editClicked', props.tarefa);
}

const handleDeleteClick = () => {
    emit('deleteClicked', props.tarefa);
}
</script>

<template>
    <tr>
        <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 align-middle whitespace-nowrap sm:pl-0">{{ props.tarefa.nome }}</td>
        <td class="px-3 py-5 text-sm text-center text-gray-500 whitespace-nowrap">
            <red v-if="props.tarefa.prioridade === 'Alta'">{{ props.tarefa.prioridade }}</red>
            <yellow v-if="props.tarefa.prioridade === 'Média'">{{ props.tarefa.prioridade }}</yellow>
            <green v-if="props.tarefa.prioridade === 'Baixa'">{{ props.tarefa.prioridade }}</green>
        </td>
        <td class="px-3 py-5 text-sm text-center text-gray-500 whitespace-nowrap">
            <red v-if="props.tarefa.status === 'Não iniciado'">{{ props.tarefa.status }}</red>
            <yellow v-if="props.tarefa.status === 'Em progresso'">{{ props.tarefa.status }}</yellow>
            <green v-if="props.tarefa.status === 'Concluído'">{{ props.tarefa.status }}</green>
        </td>
        <td class="px-3 py-4 text-sm text-center text-gray-500 whitespace-nowrap">{{ moment(props.tarefa.vencimento).format("DD/MM/YYYY") }}</td>
        <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
            <SecondaryButton @click="handleEditClick">Editar</SecondaryButton>
        </td>
        <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
            <DangerButton @click="handleDeleteClick">Deletar</DangerButton>
        </td>
    </tr>
</template>
