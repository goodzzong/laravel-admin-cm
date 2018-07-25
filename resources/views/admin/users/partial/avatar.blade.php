@php
  $size = isset($size)? $size : 48;
  if ($user->id === 1) {
    $email = 'goodzzong@gmail.com';
  }else{
    $email = $user->username;
  }
@endphp

<span style="padding-right:1rem;">
@if (isset($user) and $user)
  <a href="{{ gravatar_profile_url($email) }}" class="pull-left">
    <img alt="{{ $user->name }}" class="media-object img-thumbnail" src="{{ gravatar_url($user->email, $size) }}">
  </a>
  @else
    <a href="{{ gravatar_profile_url("Unknown@example.com") }}" class="pull-left">
    <img alt="Unknown User" class="media-object img-thumbnail" src="{{ gravatar_url("Unknown@example.com", $size) }}">
  </a>
  @endif
</span>