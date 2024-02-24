<template>
  <div v-for="e in entries" class="nowPlayingEntry">
    <span class="nowPlayingUser">{{e.user_name}}</span> is playing <span class="nowPlayingSong">{{e.current_song?.title}}</span>
    by  <a :href="`#/artist/${e.current_song?.artist_id}`">{{ e.current_song?.artist_name }}</a> from <a :href="`#/album/${e.current_song?.album_id}`">{{ e.current_song?.album_name }}</a>
  </div>
</template>

<script lang="ts" setup>
import { computed, toRef } from 'vue'
import { nowPlayingStore } from '@/stores'

const entries = toRef(nowPlayingStore.state, 'entries')
</script>
<style>
.nowPlayingEntry {
    border: 2px black solid;
}
.nowPlayingUser {
    font-style: italic;
}
.nowPlayingSong {
    font-weight: bold;
}
</style>