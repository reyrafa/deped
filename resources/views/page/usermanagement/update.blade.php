<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Management</h2>
    </x-slot>
    <div class="container">
        <form action="/update/teacher" method="POST">
            @csrf
            @foreach($teacher as $teacher_info)
            <input type="hidden" value="{{$teacher_info->id}}" name="id">
            <div class="mt-4 row">

                <div class="col-md-12 mb-1">
                    <h1 style="font-size: 25px; font-weight:bold">Add Teacher</h1>
                    <hr>
                </div>         
                
                <div class="col-md-12 mb-3">
                    <span style="font-size: 12px;">Note: input field with <span class="text-danger">*</span> is required</span>
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Id Number<span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="id_number"
                        value="{{$teacher_info->id_number}}"
                        placeholder="ID number"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Firstname <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="firstname"
                        placeholder="Firstname"
                        value="{{$teacher_info->firstname}}"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Lastname <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="lastname"
                        placeholder="Lastname"
                        value="{{$teacher_info->lastname}}"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Middlename <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="middlename"
                        value="{{$teacher_info->middlename}}"
                        placeholder="Middlename"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="hidden">
                    <x-jet-input
                        type="number"
                        name="org"
                        value="1"
                    />
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 "></div>
                <div class="col-md-12 mb-3 mt-5">
                    <h1 style="font-size: 20px; font-weight:bold">Login Credentials</h1>
                        <hr>
                </div>
                <div class="col-md-3 mb-2">
                    @foreach($user as $user_info)
                    <x-jet-label id="label">Email Address <span class="text-danger">*</span></x-jet-label>
                        <x-jet-input
                            type="email"
                            name="email"
                            value="{{$user_info->email}}"
                            id="email"
                            placeholder="Email Address"
                            class="form-control"
                            required autofocus
                        />
                        <span
                        style="color: red; font-size: 10px"
                        id="emailError"
                        class="ml-2 hidden"
                        >Whoops, Email Address is already used!
                      </span>
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Retype Email Address <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="email" 
                        name="reemail"
                        id="reemail" 
                        value="{{$user_info->email}}" 
                        required
                        class="form-control"
                        placeholder="Retype Email Address"
                      />
                      <span
                        style="color: red; font-size: 10px"
                        id="reemailError"
                        class="ml-2 hidden"
                        >Whoops, these don't match!
                      </span>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Password <span class="text-danger">*</span></x-jet-label>
                        <x-jet-input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            class="form-control"
                            required autofocus
                        />
                        <span
                        style="color: red; font-size: 10px"
                        id="passwordError"
                        class="ml-2 hidden"
                        >Whoops, Password should be atleast 8 character!
                      </span>
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Password Confirmation <span class="text-danger">*</span></x-jet-label>
                        <x-jet-input
                            type="password"
                            name="repassword"
                            id="repassword"
                            placeholder="Retype Password"
                            class="form-control"
                            required autofocus
                        />
                        <span
                        style="color: red; font-size: 10px"
                        id="repasswordError"
                        class="ml-2 hidden"
                        >Whoops, these should match!
                      </span>
                </div>
                @endforeach
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-3 mt-2">
                    <x-jet-button type="submit" id="submit">Update Teacher</x-jet-button>
                </div>
            </div>
            @endforeach
        </form> 
    </div>
    @push('script')
        <script>
            $(document).ready(function(){
                //validating the email 
                $('#email').keyup(function(){
                    var variable = this.value
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to("validateEmailAdd")!!}',
                        data:{'id':variable},
                        success: function(data){
                            console.log("success")
                            console.log(data)
                            if(data.length >= 1){
                              $('#submit').attr('disabled', 'disabled')
                             $('#emailError').show()
                            }
                            else{
                              $('#emailError').hide()
                              $('#submit').removeAttr('disabled')
                            }
                            },
                        error: function(error){
                          console.log("fails");
                          console.log(JSON.stringify(error))
                        }
                    })
                })
                //reemail should match
                $('#reemail').keyup(function(){
                    var email = $('#email').val()
                    var reemail = this.value
                    if(email != reemail){
                        $('#reemailError').show()
                        $('#submit').attr('disabled', 'disabled')
                    }
                    else{
                        $('#reemailError').hide()
                        $('#submit').removeAttr('disabled') 
                    }
                })
                //password validation
                $('#password').keyup(function(){
                    var password = this.value
                    if(password.length < 8){
                        $('#passwordError').show()
                        $('#submit').attr('disabled', 'disabled')
                    }
                    else{
                        $('#passwordError').hide()
                        $('#submit').removeAttr('disabled') 
                    }
                })
                //retype password validation
                $('#repassword').keyup(function(){
                    var password = $('#password').val()
                    var repassword = this.value
                    if(repassword != password){
                        $('#repasswordError').show()
                        $('#submit').attr('disabled', 'disabled')
                    }
                    else{
                        $('#repasswordError').hide()
                        $('#submit').removeAttr('disabled') 
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>