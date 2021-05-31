<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.1.4/tailwind.min.css" rel="stylesheet">

<main class="mx-auto max-w-4xl bg-gray-200 mb-24"x-data="{'layout': 'list'}">
  <nav class="p-4 bg-indigo-700 text-indigo-100">
    Layout:
    <button type="button" class="mx-1 px-2 py-1 hover:bg-indigo-900" x-on:click="layout = 'list'" x-bind:class="{'bg-indigo-800': layout === 'list'}">List</button>
    <button type="button" class="mx-1 px-2 py-1 hover:bg-indigo-900" x-on:click="layout = 'grid'" x-bind:class="{'bg-indigo-800': layout === 'grid'}">Grid</button>
  </nav>

  <section class="flex flex-wrap" x-bind:class="{'pb-4': layout === 'list', 'p-2': layout === 'grid'}">
 
    <div class="" x-bind:class="{'w-full m-4 mb-0': layout === 'list', 'w-1/4 p-2': layout === 'grid'}">
      <article class="bg-white p-4 shadow">
        <h2 class="mb-4 text-2xl text-blue-900 font-black font-serif">
          <a href="#" class="hover:underline hover:text-black">Cool Article Title</a>
        </h2>
        <div class="flex flex-row">
          <img src="https://source.unsplash.com/200x200/?cat,kitten,kitty" class="w-48">
          <div class="flex-1 flex flex-col justify-between text-xl font-light ml-4" x-show="layout === 'list'" x-cloak>
            <p>Article synopsis a few sentences long. I'm just typing stuff to fill in the space. Spoiler: it's about cats. Lots of cats. Cats everywhere. There might be kittens. You never know.</p>
            <p class="text-right">
              <a href="#" class="uppercase text-base text-gray-600 hover:text-black">Read more →</a>
            </p>
          </div>
        </div>
      </article>
    </div>

    <div class="" x-bind:class="{'w-full m-4 mb-0': layout === 'list', 'w-1/4 p-2': layout === 'grid'}">
      <article class="bg-white p-4 shadow">
        <h2 class="mb-4 text-2xl text-indigo-900 font-black font-serif">
          <a href="#" class="hover:underline hover:text-black">Cool Article Title</a>
        </h2>
        <div class="flex flex-row">
          <img src="https://source.unsplash.com/200x200/?cat,kitten,kitty" class="w-48">
          <div class="flex-1 flex flex-col justify-between text-xl font-light ml-4" x-show="layout === 'list'" x-cloak>
            <p>Article synopsis a few sentences long. I'm just typing stuff to fill in the space. Spoiler: it's about cats. Lots of cats. Cats everywhere. There might be kittens. You never know.</p>
            <p class="text-right">
              <a href="#" class="uppercase text-base text-gray-600 hover:text-black">Read more →</a>
            </p>
          </div>
        </div>
      </article>
    </div>

  </section>
</main>