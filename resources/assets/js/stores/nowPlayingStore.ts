import { reactive } from 'vue'

export const nowPlayingStore = {
  state: reactive({
    entries: [] as QueueState[]
  }),
  update(newEntries: QueueState[]) {
    newEntries.forEach( ne => {
        var hit = false;
        var skip = false;
        this.state.entries.forEach( ee => {
            if (!skip && ne.user_name == ee.user_name)
            {
                hit = ne.current_song?.id == ee.current_song?.id;
                skip = true;
            }
        })
        if (!hit) {
            this.state.entries.unshift(ne)
            this.state.entries = this.state.entries.slice(0, 30)
        }
    })
  }
}