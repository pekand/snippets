section .data
    ; Array of 64-bit integers (QWORDs)
    my_array    dq 5, 10, 20, 4, 1  
    
    ; Calculate the number of elements in the array
    ; ($ - current address, my_array = start address)
    array_len   equ ($ - my_array) / 8  ; 8 bytes per QWORD

section .text
    global main

main:
    ; Register roles:
    ; RAX = Accumulator (stores the running total sum)
    ; RDI = Pointer (holds the current address in the array)
    ; RCX = Counter (holds the loop iteration count)
    
    ; 1. Initialization
    mov rax, 0                          ; RAX = 0 (Initialize sum)
    mov rdi, my_array                   ; RDI = Address of the first element (5)
    mov rcx, array_len                  ; RCX = 5 (Total number of elements)
    
loop_start:
    ; 2. Add the current element to the sum (RAX)
    ; [RDI] means: take the QWORD value stored at the address in RDI
    add rax, [rdi]
    
    ; 3. Move the pointer to the next element
    ; We add 8 because each element (QWORD) is 8 bytes long (64-bit)
    add rdi, 8
    
    ; 4. Decrement the counter
    loop_decrement:
    dec rcx     ; Decrement the 64-bit counter (RCX)
    jnz loop_start ; Jump back to 'loop_start' label if RCX is not zero
    
    ; 5. Loop control (Jumps back to loop_start if RCX is not zero)
    ; The 'loop' instruction implicitly decrements RCX and jumps if non-zero
    
    jmp loop_start                      ; This line is just conceptual here.