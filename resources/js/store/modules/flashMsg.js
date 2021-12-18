const modules = {
}

const state = {
  isFlash: false,
  messages: [],
}

const getters = {
}

const actions = {
  pushMessage (context, message) {
    const messages = _.cloneDeep(context.state.messages)
    messages.push(message)
    context.commit('setMessages', messages)
  },
  removeMessage (context, index) {
    const messages = _.cloneDeep(context.state.messages)
    messages.splice(index, 1)
    context.commit('setMessages', messages)
  },
  flash (context) {
    context.commit('setIsFlash', true)
  },
  clear (context) {
    context.commit('setIsFlash', false)
    context.commit('setMessages', [])
  },
}

const mutations = {
  setMessages (state, messages) {
    state.messages = messages
  },
  setIsFlash (state, isLoading) {
    state.isLoading = isLoading
  },
}

export default {
  namespaced: true,
  modules,
  state,
  getters,
  actions,
  mutations,
}
