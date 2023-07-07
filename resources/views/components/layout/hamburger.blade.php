<style>
    .hamburger {
        width: 20px;
        height: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
    }

    .hamburger span {
        width: 100%;
        height: 2px;
        background-color: var(--text-color);
        transform-origin: 0 50%;
        transition: opacity 0.3s, transform 0.3s;
    }

    .hamburger.opened span:nth-child(1) {
        transform: rotate(45deg)
    }

    .hamburger.opened span:nth-child(2) {
        opacity: 0;
    }

    .hamburger.opened span:nth-child(3) {
        transform: rotate(-45deg);
    }
</style>

{{-- Don't mind the Alpine stuff here, it comes from x-layout.header --}}
<div
    class="hamburger b"
    style="margin-left:16px;"
    :class="{ 'opened': opened }"
    @click="toggle"
    @clickoutside="close"
>
    <span></span>
    <span></span>
    <span></span>
</div>
