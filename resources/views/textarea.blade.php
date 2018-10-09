<textarea :name="'attendees.' + index + '.custom_fields.{{ name }}'" id="{{ name }}"
          v-model="attendee.custom_fields.{{ name }}"></textarea>