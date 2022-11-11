import { ref } from 'vue'
import { defineStore } from 'pinia'

type flashMsg = {
  message: string
  color: string
  key: string
}

export const useFlashMsgStore = defineStore('flash-message', () => {
  //-------------
  // states
  //-------------
  const messages = ref<flashMsg[]>([])

  // local functions
  const pushFlashMessage = (message: string, color: string) => {
    const copiedMessages = messages.value.slice()
    copiedMessages.push({
      message: message,
      color: color,
      key: Date.now().toString() + message,
    })
    messages.value = copiedMessages
  }

  //-------------
  // getters
  //-------------

  //-------------
  // actions
  //-------------
  const pushSuccessMessage = (message: string) => {
    pushFlashMessage(message, 'success')
  }
  const pushErrorMessage = (message: string) => {
    pushFlashMessage(message, 'red accent-2')
  }

  const removeMessage = (key: string) => {
    const copiedMessages = messages.value.slice()
    messages.value.forEach((flashMsg, idx) => {
      if (flashMsg.key === key) {
        copiedMessages.splice(idx, 1)
        return
      }
    })
    messages.value = copiedMessages
  }

  return {
    //-------------
    // states
    //-------------
    messages,
    //-------------
    // getters
    //-------------

    //-------------
    // actions
    //-------------
    pushSuccessMessage,
    pushErrorMessage,
    removeMessage,
  }
})
