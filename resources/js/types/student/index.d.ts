export interface StudentType {
  id: string;
  name_of_student: string;
  name_in_khmer: string;
  date_of_birth: string;
  sex: string;
  phone: string;
  emergency_phone: string;
  grade: string;
  profile_photo: string;
  address?: Address;
  place_of_birth?: PlaceOfBirth;
  transfered?: boolean;
  transferred_from?: string;
  transfer_to_year?: string;
  father_name: string;
  mother_name: string;
  father_job_and_address: string;
  mother_job_and_address: string;
  student_groups?: StudentGroup[];
  payments?: Payment[];
}

export interface Address {
  province?: string;
  district?: string;
  commune?: string;
  village?: string;
  house?: null;
  street?: null;
}

export interface Payment {
  indentity: string;
  receipt_no: string;
  academic_year: string;
  id: string;
  dys: string;
  fee_type: string;
  amount: string;
  discount: string;
  amount_in_word: string;
  note: string;
  semester: string;
  scholarship: string;
  received_date: string;
  modified_date: string;
}

export interface PlaceOfBirth {
  province: string;
  district: string;
  commune: string;
  village: string;
}

export interface StudentGroup {
  gno: string;
  department: string;
  major_id: string;
  year: number;
  semester: string;
  group: string;
  academic_year: string;
  batch: number;
  note: string;
  dmys: string;
  students_count: number;
  dys_attr: string;
  dysg_attr: string;
  shift: string;
  admission: boolean;
  suspend: boolean;
  suspend_date: string;
  suspend_end_date: string;
}

export interface StudentOldType {
  supper_id: string;
  family_name: string;
  middle_name?: string | null;
  first_name: string;
  full_name: string;
  gender: string;
  nationality: string;
  birth_date: string;
  birth_month: string;
  birth_year: string;
  city: string;
  current_address: string;
  father_name: string;
  father_current_job: string;
  mother_name: string;
  mother_current_job: string;
  khmer_name: string;
  khmer_name_limon: string;
  khmer_nationality: string;
  khmer_city: string;
  khmer_current_address: string;
  khmer_father_name: string;
  khmer_father_current_job: string;
  khmer_mother_name: string;
  khmer_mother_current_job: string;
  transfer_remark: null;
  phone_number: string;
  academic_year: string;
  comment: string;
  khmer_gender: string;
  batch: string;
  phone: string;
  profile_photo: string;
  studentGroups?: {
    supper_id: string;
    tdysg: string;
    academic_year: string;
    department: string;
    suspend: string;
  }[];
  payments?: {
    supper_id: string;
    no: string;
    academic_year: string;
    tdys: string;
    semester1: null | string;
    semester2: null | string;
    payment: string;
    due_date: string;
    fee: string;
    sequence: string;
  }[];
  grade?: {
    supperid: string;
    type: string;
    total_grade: string;
    score: string;
    high_school: string;
    high_school_province: string;
  };
}
