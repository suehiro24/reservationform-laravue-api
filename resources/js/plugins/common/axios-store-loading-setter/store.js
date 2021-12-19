const modules = {
}

const state = {
  isLoading: false,
  counter: 0,
}

const getters = {
}

const actions = {
  updateIsLoading (context, isLoading) {
    if (isLoading) {
      context.commit('increment')
      context.commit('setIsLoading', isLoading)
      console.log('Incremented calling api counter', context.state.counter)
    } else {
      // falseに切り替わった場合は即時に次の通信が始まる可能性があるので, 特定ミリ秒待ってから切り替える
      setTimeout(() => {
        context.commit('decrement')
        console.log('Decremented calling api counter', context.state.counter)
        if (context.state.counter === 0) {
          context.commit('setIsLoading', isLoading)
          console.log('Finish loding')
        }
      }, 500)
    }
  },
}

const mutations = {
  setIsLoading (state, isLoading) {
    state.isLoading = isLoading
  },
  increment (state) {
    state.counter++
  },
  decrement (state) {
    state.counter--
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
