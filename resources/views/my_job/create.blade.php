<x-layout>
    <x-breadcrumbs :links="['My jobs' => route('my-jobs.index'), 'Create' => '#']" class="mb-4" />
    <x-card class="mb-8">
        <form action="{{ route('my-jobs.store') }}" method="POST">
            @csrf
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input name="title" value="{{ old('title') }}" />
                </div>

                <div>
                    <x-label for="location" :required="true">Job Location</x-label>
                    <x-text-input name="location" value="{{ old('location') }}" />
                </div>

                <div class="col-span-2">
                    <x-label for="salary" :required="true">Salary</x-label>
                    <x-text-input name="salary" value="{{ old('salary') }}" type="number" />
                </div>


                <div class="col-span-2">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input name="description" value="{{ old('description') }}" type="textarea" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group :allOption="false" name="experience" :value="old('experience')"
                        :options="array_combine(array_map('ucfirst', \App\Models\Job::$experience), \App\Models\Job::$experience)" />
                </div>

                <div>
                    <x-label for="category" :required="true">Category</x-label>
                    <x-radio-group :allOption="false" name="category" :value="old('category')"
                        :options="array_combine(array_map('ucfirst', \App\Models\Job::$category), \App\Models\Job::$category)" />
                </div>
                <div class="col-span-2">
                    <x-button class="w-full">Create Job</x-button>
                </div>
            </div>
        </form>
    </x-card>

</x-layout>