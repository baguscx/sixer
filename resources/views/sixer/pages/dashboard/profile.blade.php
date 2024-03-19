@extends('sixer.layouts.app')
@section('title', 'Edit Profile')
@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit My Profile
                    </h2>
                    <p class="text-sm text-gray-400">
                        Enter your data Correctly & Properly
                    </p>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">

                        <form action="{{ route('member.profile.update', [Auth::User()->id]) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6">
                                            <div class="flex items-center mt-1">
                                                @if(auth()->user()->detail_user()->first()->photo != NULL)
                                                    <img src="{{(Storage::url(auth()->user()->detail_user()->first()->photo))}}" alt="photo profile" class="rounded-full w-16 h-16">
                                                @else
                                                    <span class="inline-block w-16 h-16 overflow-hidden bg-gray-100 rounded-full">
                                                            <svg class="w-full h-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                    </span>
                                                @endif

                                                <label for="choose" class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Choose File</label>

                                                <input type="file" accept="image/*" id="choose" name="photo" hidden>

                                                <a href="{{route('member.delete.photo.profile')}}" type="button" class="px-3 py-2 ml-5 text-sm font-medium leading-4 text-red-700 bg-transparent rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Are u sure want to delete your photo?')">
                                                    Delete
                                                </a>
                                            </div>

                                            @error('photo')
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('photo') }}</p>
                                            @enderror
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Full Name</label>
                                            <input placeholder="Your Name" type="text" name="name" id="name" autocomplete="name" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{Auth::user()->name ?? ''}}" required>
                                            @error('name')
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                                            @enderror
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="role" class="block mb-3 font-medium text-gray-700 text-md">Role</label>
                                            <input placeholder="your role" type="text" name="role" id="role" autocomplete="role" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ Auth::user()->detail_user()->first()->role ?? '' }}" required>
                                            @error('role')
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('role') }}</p>
                                            @enderror
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="email" class="block mb-3 font-medium text-gray-700 text-md">Email Address</label>
                                            <input placeholder="your email" type="email" name="email" id="email" autocomplete="email" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{ Auth::user()->email ?? ''}}" required>
                                            @error('email')
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                                            @enderror
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="contact_number" class="block mb-3 font-medium text-gray-700 text-md">Contact Number</label>
                                            <input placeholder="1234567890" type="number" name="contact_number" id="contact_number" autocomplete="contact_number" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{Auth::user()->detail_user()->first()->contact_number ?? ''}}" required>
                                            @error('contact_number')
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('contact_number') }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-span-6">
                                            <label for="biography" class="block mb-3 font-medium text-gray-700 text-md">Biografi</label>
                                            <textarea placeholder="Enter your biography here.." type="text" name="biography" id="biography" autocomplete="biography" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" rows="4">{{Auth::User()->detail_user()->first()->biography ?? ''}}</textarea>
                                            @error('name')
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                                            @enderror
                                        </div>


                                        <div class="col-span-6">
                                            <label for="service-name" class="block mb-3 font-medium text-gray-700 text-md">My Experience</label>
                                            @forelse ($experience_user as $key => $item)
                                                <input placeholder="More than 9 years of experience" type="text" name="{{'experience['.$item->id.']'}}" id="{{'experience['.$item->id.']'}}" autocomplete="{{'experience['.$item->id.']'}}" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm" value="{{$item->experience}}">
                                                @error('experience['.$item->id.']')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('experience['.$item->id.']') }}</p>
                                                @enderror
                                            @empty
                                                <input placeholder="Knowledge in the fields of interface design, marketing and etc" type="text" name="experience[]" id="experience" autocomplete="experience" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('experience')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('experience') }}</p>
                                                @enderror

                                                <input placeholder="Knowledge in the fields of interface design, marketing and etc" type="text" name="experience[]" id="experience" autocomplete="experience" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('experience')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('experience') }}</p>
                                                @enderror

                                                <input placeholder="Knowledge in the fields of interface design, marketing and etc" type="text" name="experience[]" id="experience" autocomplete="experience" class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                                @error('experience')
                                                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('experience') }}</p>
                                                @enderror
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href="{{ route('member.dashboard.index') }}" type="button" class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" onclick="return confirm('Are you sure want to cancel?, Any changes you make will not be saved.')">
                                        Cancel
                                    </a>
                                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="return confirm('Are you sure want to save changes?')">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection
