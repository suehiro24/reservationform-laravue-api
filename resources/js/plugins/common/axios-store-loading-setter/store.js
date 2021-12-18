const modules = {
}

const state = {
  isLoading: false,
}

const getters = {
}

const actions = {
  updateIsLoading (context, isLoading) {
    if (isLoading) {
      context.commit('setIsLoading', isLoading)
    } else {
      // falseに切り替わった場合は即時に次の通信が始まる可能性があるので, 特定ミリ秒待ってから切り替える
      setTimeout(() => context.commit('setIsLoading', isLoading), 500, isLoading)
    }
  },
}

const mutations = {
  setIsLoading (state, isLoading) {
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
