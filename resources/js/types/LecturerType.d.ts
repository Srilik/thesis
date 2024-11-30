import { SubjectType } from "@/types/schedule/SubjectType";
import { ScheduleType, ScheduleViewType } from "@/types/schedule/ScheduleType";
import { DayTimeType } from "./schedule/DayTimeType";
import { SubjectSessionType } from "@/types/schedule/SubjectSessionType";
import { LecturerAbsentType } from "@/types/schedule/LecturerAbsentType";
import { MakeUpClassType } from "@/types/schedule/MakeUpClassType";

export interface LecturerType {
  id: number;
  ShortName: string;
  name: string;
  name_kh: string | null;
  title_name: string;
  name_kh_en?: string | null;
  type: string;
  teachable: boolean;
  position: string;
  department: string;
  profile: string | null;
  title: string;
  gender: string;
  email?: string;
  mobile?: string;
  subjects?: SubjectType[];
  subjects_count?: number;
  schedules_count?: number;
  schedules?: ScheduleType[];
  schedules_view?: ScheduleViewType[];
  sessions?: LecturerSessionType;
  subjectSessions?: SubjectSessionType;
  absents?: LecturerAbsentType[];
  makeup_classes?: MakeUpClassType[];
  is_assistant?: boolean;
  status?: string;
}

export interface LecturerSessionType {
  monthCount: number;
  weekCount: number;
  sessionCount: number;
  sessions?: {
    date: string;
    dayTime: DayTimeType[];
  }[];
}
