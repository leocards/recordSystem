import axios from "axios";
import { ref } from "vue";
import { defineStore } from "pinia";

export const useDocumentStore = defineStore("Document", () => {
    const url = ref(null)
    const document = ref(null)
    const documentType = ref(null)

    const getDocument = (docu) => {
        let file = docu.split('/')[docu.split('/').length - 1]
        documentType.value = (file.split('.')[file.split('.').length - 1]).toLowerCase()
        url.value = '/'+docu
        document.value = file
    }

    const closeDocument = () => {
        url.value = null
        document.value = null
        documentType.value = null
    }

    return {
        url,
        document,
        documentType,

        getDocument,
        closeDocument
    }
});
