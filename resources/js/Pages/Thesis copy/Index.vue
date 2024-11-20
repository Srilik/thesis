<script setup lang="ts">
import StaffLayout from "@/Layouts/StaffLayout.vue";

import { Link } from "@inertiajs/vue3";
import useAuth from "@/Composables/useAuth";
import SvgIcon from "@components/SvgIcon.vue";

const { hasAnyPermission } = useAuth();
</script>
<template>
  <StaffLayout>
    <div class="p-2">
      <div class="flex flex-wrap">
        <Link
          :href="route('thesis.management.index')"
          class="w-full md:w-1/3 lg:w-1/5 p-2 transform hover:scale-105 ease-in duration-300"
        >
          <div
            class="bg-green-200 dark:bg-green-700 w-full h-full rounded-xl shadow-xl overflow-hidden"
          >
            <div class="p-2">
              <!--Icon-->
              <div
                class="bg-green-100 dark:bg-green-500 rounded-xl grid place-content-center p-3"
              >
                <SvgIcon class="w-24" name="book-shelf" />
              </div>
            </div>
            <div class="p-2 flex justify-center items-center">
              <!--Text-->
              <h2 class="text-lg font-bold text-center">
                Thesis Management System
              </h2>
            </div>
          </div>
        </Link>
      </div>
    </div>
  </StaffLayout>
</template>
