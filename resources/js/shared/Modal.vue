<template>

    <div ref="modal" class="modal fade background-darken" tabindex="-1" role="dialog" :class="{in:isOpen,show:isShow}" @click.self="close()" @keyup.esc="close()">
        <div class="modal-dialog" :class="modalSize" role="document">
            <div class="modal-content">
                <slot name="form">
                    <div v-if="needHeader" class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">
                            <slot name="title">
                                Modal
                            </slot>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            Body
                        </slot>
                    </div>
                    <div v-if="needFooter" class="modal-footer">
                        <slot name="footer">

                        </slot>
                    </div>
                </slot>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</template>

<script>
export default {
  props: {
    opened: {
      type: Function,
      default: () => {}
    },
    closed: {
      type: Function,
      default: () => {}
    },
    needHeader: {
      type: Boolean,
      default: true
    },
    needFooter: {
      type: Boolean,
      default: true
    },
    size: {
      type: String,
      default: ''
    },
  },
  data() {
    return {
      sizeClasses: {
        large: 'modal-lg',
        small: 'modal-sm',
        medium: 'modal-md',
        full: 'modal-full'
      },
      isOpen: false,
      isShow: false,
      lastKnownBodyStyle: {
        overflow: 'auto'
      }
    }
  },
  methods: {
    open() {
      if (this.isShow) {
        return
      }
      this.isShow = true
      this.$nextTick(() => {
        this.isOpen = true
        this.$refs.modal.focus()
        this.lastKnownBodyStyle.overflow = document.body.style.overflow
        document.body.style.overflow = 'hidden'
        this.opened()
      })
    },
    close() {
      this.isOpen = false
      this.$nextTick(() => {
        setTimeout(() => {
          this.isShow = false
          document.body.style.overflow = this.lastKnownBodyStyle.overflow
          this.closed()
        }, 500)
      })
    }
  },
  computed: {
    modalSize: function() {
      return this.sizeClasses[this.size] || ''
    }
  }
}
</script>


<style scoped>
.background-darken {
  background-color: rgba(10,10,10,.86);
}
.modal-footer, .modal-header {
    border-bottom: 1px solid #dbdbdb;
    align-items: center;
    background-color: #f5f5f5;
    display: flex;
    flex-shrink: 0;
    justify-content: flex-start;
    padding: 20px;
    position: relative;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}

.modal-content {
  border-top-left-radius: 6px;
  border-top-right-radius: 6px;
}
.modal {
  overflow-x: hidden;
  overflow-y: auto;
}
.modal-full {
  margin-left: 16px;
  margin-right: 16px;
  width: auto;
}
.modal-dialog {
  margin: 150px auto;
}
</style>